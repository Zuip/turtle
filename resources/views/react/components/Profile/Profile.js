import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../Layout/Grids/BaseLayout';
import TwoColumnLayout from '../Layout/Grids/TwoColumnLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import getUser from '../../apiCalls/getUser';
import NotFoundPage from '../NotFoundPage';
import pageSpinner from '../../services/pageSpinner';
import TripsTable from './TripsTable';
import ProfileStyle from '../../style/components/Profile';
import UserArticles from './UserArticles';

class Profile extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      user: null
    }
  }

  componentDidMount() {
    this.loadUser();
  }

  componentDidUpdate(previousProps) {

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

  loadUser() {

    let userName = this.props.match.params.user;

    if(typeof userName === 'undefined') {

      if(this.props.user === null) {
        this.setState({ user: null });
        return;
      }

      userName = this.props.user.name;
    }

    pageSpinner.start('article');

    getUser(
      userName
    ).then(user => {
      this.setState({ user });
      pageSpinner.finish('article');
    }).catch(error => {
      
      if(error.status === 404) {
        this.setState({ user: null });
        pageSpinner.finish('article');
        return;
      }

      console.log(error);
    });
  }

  render() {

    if(this.state.user === null) {
      return <NotFoundPage />;
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
        <TwoColumnLayout mobile={{ rightColumnIsOnTop: true }}>
          <FirstColumn>
            <TripsTable user={this.state.user} />
          </FirstColumn>
          <SecondColumn>
            <UserArticles user={this.state.user} />
          </SecondColumn>
        </TwoColumnLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({
    user: state.user
  })
)(Profile);