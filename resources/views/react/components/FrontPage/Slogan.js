import React from 'react';
import { connect } from 'react-redux';

class Slogan extends React.Component {
  render() {
    return (
      <div id="frontpage-slogan" className="info-box">
        <h1>Turtle.travel: {this.props.translations.slogan}</h1>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Slogan);
