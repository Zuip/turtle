import React from 'react';

class Overlay extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="overlay">
        <div className="content">
          {this.props.content}
        </div>
      </div>
    );
  }
}

export default Overlay;
