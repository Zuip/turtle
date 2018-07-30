import React from 'react';

class SecondColumn extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="grid-second-column">
        {this.props.children}
      </div>
    );
  }
}

export default SecondColumn;