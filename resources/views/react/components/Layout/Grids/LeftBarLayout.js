import React from 'react';

class LeftBarLayout extends React.Component {

  constructor(props) {
    super(props);
  }

  getStyle() {
    
    if(this.props.useFullHeight) {
      return {
        minHeight: '100%'
      };
    }

    return null;
  }

  render() {
    return (
      <div className="left-bar-grid-container" style={this.getStyle()}>
        {this.props.children}
      </div>
    );
  }
}

export default LeftBarLayout;