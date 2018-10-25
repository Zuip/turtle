import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../Layout/Grids/BaseLayout';
import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import getUser from '../../apiCalls/users/getUser';
import getUserTrips from '../../apiCalls/trips/getUserTrips';
import NotFoundPage from '../NotFoundPage';
import pageSpinner from '../../services/pageSpinner';
import logError from '../../services/logError';
import ProfileStyle from '../../style/components/Profile';

import TripsTable from './src/TripsTable';
import UserArticles from './src/UserArticles';
import VisitedCitiesMap from './src/VisitedCitiesMap';

class Profile extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      trips: null,
      user: null
    }
  }

  componentDidMount() {
    this.loadUser().then(
      user => this.loadTrips(user)
    );
  }

  componentDidUpdate(previousProps) {

    if(previousProps.translations.language !== this.props.translations.language) {
      this.props.history.push(
        '/' + this.props.translations.routes.users
        + '/' + this.props.match.params.user
      );
      return;
    }

    if(previousProps.match.params.user !== this.props.match.params.user) {
      this.loadUser();
      return;
    }

    if(typeof this.props.match.params.user === 'undefined') {
      if(previousProps.user !== this.props.user) {
        this.loadUser();
      }
    }
  }

  loadTrips(user) {

    pageSpinner.start('trips');

    return getUserTrips(
      user.id,
      this.props.translations.language
    ).then(
      trips => trips.filter(trip => trip.visits.length)
    ).then(trips => {
      this.setState({ trips });
      pageSpinner.finish('trips');
    }).catch(error => {
      logError(error, 'components/Profile/Profile.js (trips)');
    });
  }

  loadUser() {

    let userName = this.props.match.params.user;

    if(typeof userName === 'undefined') {

      if(this.props.user === null) {
        this.setState({ user: null });
        return;
      }

      userName = this.props.user.name;
    }

    pageSpinner.start('Profile user');

    return getUser(
      userName
    ).then(user => {
      this.setState({ user });
      pageSpinner.finish('Profile user');
      return user;
    }).catch(error => {
      
      if(error.status === 404) {
        this.setState({ user: null });
        pageSpinner.finish('Profile user');
        return;
      }

      logError(error, 'components/Profile/Profile.js (user)');
    });
  }

  render() {

    if(this.state.user === null) {
      return <NotFoundPage />;
    }

    if(this.state.trips === null) {
      return null;
    }

    return (
      <BaseLayout>
        <TwoColumnLayout>
          <FirstColumn>

            <h2 style={ProfileStyle.h2}>

              <i className="fas fa-user-circle"
                style={ProfileStyle.userCircleIcon}>
              </i>

              {this.state.user.name}
              
            </h2>

          </FirstColumn>
        </TwoColumnLayout>
        <TwoColumnLayout>
          <FirstColumn>

            <TripsTable
              trips={this.state.trips}
              user={this.state.user}
            />

          </FirstColumn>
          <SecondColumn>

            <VisitedCitiesMap
              trips={this.state.trips}
              user={this.state.user}
            />

            <UserArticles user={this.state.user} />
            
          </SecondColumn>
        </TwoColumnLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(Profile);