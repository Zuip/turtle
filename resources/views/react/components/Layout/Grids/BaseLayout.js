import React from 'react';

class BaseLayout extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="content-grid-base-layout">
        {this.props.children}
      </div>
    );
  }
}

export default BaseLayout;