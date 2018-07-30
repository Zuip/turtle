import React from 'react';

class TwoColumnLayout extends React.Component {

  constructor(props) {
    super(props);
  }

  rightColumnIsOnTopOnMobile() {

    if(typeof this.props.mobile === 'undefined') {
      return false;
    }

    if(typeof this.props.mobile.rightColumnIsOnTop === 'undefined') {
      return false;
    }

    return this.props.mobile.rightColumnIsOnTop;
  }

  render() {

    if(this.rightColumnIsOnTopOnMobile()) {
      return (
        <div className="two-column-right-on-top-grid-container">
          {this.props.children}
        </div>
      );
    }

    return (
      <div className="two-column-grid-container">
        {this.props.children}
      </div>
    );
  }
}

export default TwoColumnLayout;