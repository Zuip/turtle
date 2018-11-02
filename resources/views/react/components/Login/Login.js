import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import BaseLayout from '../Layout/Grids/BaseLayout';
import logError from '../../services/logError';
import pageSpinner from '../../services/pageSpinner';
import postLogin from '../../apiCalls/users/postLogin';
import setCurrentUser from '../../services/setCurrentUser';

class Login extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      incorrect: false,
      username: '',
      password: ''
    };
  }

  login() {

    pageSpinner.start('Login');

    this.setState({
      incorrect: false
    });

    postLogin(
      this.state.username,
      this.state.password
    ).then(user => {

      this.setState({
        username: '',
        password: ''
      });

      setCurrentUser(user);

      pageSpinner.finish('Login');
      
    }).catch(error => {

      if(error.status === 404) {

        pageSpinner.finish('Login');

        this.setState({
          incorrect: true
        });

        return;
      }
      
      logError(error, 'components/Login/Login.js')
    });
  }

  handleUsernameChange(e) {
    this.setState({ username: e.target.value });
  }

  handlePasswordChange(e) {
    this.setState({ password: e.target.value });
  }

  handleKeyPressInInputField(e) {
    if (e.key === 'Enter') {
      this.login();
    }
  }

  getIncorrectMessage() {

    if(!this.state.incorrect) {
      return null;
    }

    return (
      <div class="alert alert-danger">
        {this.props.translations.login.incorrect}
      </div>
    );
  }

  render() {

    if(this.props.user) {
      return (
        <BaseLayout>
          <ArticleLayout>
            <h3>{this.props.translations.login.login}</h3>
            <p>{this.props.translations.login.loginSucceeded}</p>
          </ArticleLayout>
        </BaseLayout>
      );
    }

    return (
      <BaseLayout>
        <ArticleLayout>
          <h3>{this.props.translations.login.login}</h3>

          {this.getIncorrectMessage()}

          <div className="form-group">
            <p>
              <label>{this.props.translations.login.username}</label>
              <input value={this.state.username}
                    className="form-control"
                    type="text"
                    onChange={this.handleUsernameChange.bind(this)}
                    onKeyPress={this.handleKeyPressInInputField.bind(this)} />
            </p>
          </div>
          <div className="form-group">
            <p>
              <label>{this.props.translations.login.password}</label>
              <input value={this.state.password}
                    className="form-control"
                    type="password"
                    onChange={this.handlePasswordChange.bind(this)}
                    onKeyPress={this.handleKeyPressInInputField.bind(this)} />
            </p>
          </div>
          <p>
            <button type="submit"
                    className="btn btn-primary float-right"
                    onClick={this.login.bind(this)}>

              {this.props.translations.login.login}

            </button>
          </p>
        </ArticleLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({
    translations: state.translations,
    user: state.user
  })
)(Login);
