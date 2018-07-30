import React from 'react';

class FirstColumn extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="grid-first-column">
        {this.props.children}
      </div>
    );
  }
}

export default FirstColumn;