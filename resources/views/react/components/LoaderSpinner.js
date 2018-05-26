import React from 'react';
import {render} from 'react-dom';

class LoaderSpinner extends React.Component {
  render() {

    let imgStyle = {
      height: '52px',
      width: '52px',
      display: 'block',
      marginTop: '50px',
      marginBottom: '50px',
      marginLeft: 'auto',
      marginRight: 'auto'
    }

    return (
      <img src="/assets/thirdparty/spiffygif_52x52.gif" style={imgStyle}></img>
    );
  }
}

export {LoaderSpinner};
