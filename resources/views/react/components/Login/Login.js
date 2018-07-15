import React from 'react';
import { connect } from 'react-redux';

import postLogin from '../../apiCalls/postLogin';
import setCurrentUser from '../../services/setCurrentUser';

class Login extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      username: '',
      password: ''
    };
  }

  login() {
    postLogin(
      this.state.username,
      this.state.password
    ).then(user => {

      this.setState({
        username: '',
        password: ''
      });

      setCurrentUser(user);
      
    }).catch(
      error => console.log(error)
    );
  }

  handleUsernameChange(e) {
    this.setState({ username: e.target.value });
  }

  handlePasswordChange(e) {
    this.setState({ password: e.target.value });
  }

  render() {

    if(this.props.user) {
      return (
        <div>
          <h3>{this.props.translations.login.login}</h3>
          <p>{this.props.translations.login.loginSucceeded}</p>
        </div>
      );
    }

    return (
      <div>
        <h3>{this.props.translations.login.login}</h3>
        <div className="form-group">
          <p>
            <label>{this.props.translations.login.username}</label>
            <input value={this.state.username} className="form-control" type="text" onChange={this.handleUsernameChange.bind(this)} />
          </p>
        </div>
        <div className="form-group">
          <p>
            <label>{this.props.translations.login.password}</label>
            <input value={this.state.password} className="form-control" type="password" onChange={this.handlePasswordChange.bind(this)} />
          </p>
        </div>
        <p>
          <button type="submit" className="btn btn-primary float-right" onClick={this.login.bind(this)}>
            {this.props.translations.login.login}
          </button>
        </p>
      </div>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(Login);
