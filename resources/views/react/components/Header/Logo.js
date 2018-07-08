import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

class Logo extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <Link to={'/'}>
        <div id="site-name" className="header-element header-link">
          <h1>{this.props.translations.website.name}</h1>
        </div>
      </Link>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Logo);
