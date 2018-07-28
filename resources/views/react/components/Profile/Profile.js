import React from 'react';
import { connect } from 'react-redux';

import getUser from '../../apiCalls/getUser';
import NotFoundPage from '../NotFoundPage';
import pageSpinner from '../../services/pageSpinner';
import TripsTable from './TripsTable';
import ProfileStyle from '../../style/components/Profile';

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
      <div>
        <h2 style={ProfileStyle.h2}>

          <i className="fas fa-user-circle"
             style={ProfileStyle.userCircleIcon}>
          </i>

          {this.state.user.name}
          
        </h2>
        <TripsTable user={this.state.user} />
      </div>
    );
  }
}

export default connect(
  state => ({
    user: state.user
  })
)(Profile);