import React from 'react';
import {render} from 'react-dom';

import {Language} from '../services/Language.js';
import {LoaderSpinner} from './LoaderSpinner.js';

class NotFoundPage extends React.Component {

  componentDidMount() {
    Language.init(this);
  }

  render() {
    if(Language.initialized) {
      return (
        <div>
          <h2>{Language.getTranslation("404.topic")}</h2>
          <p>{Language.getTranslation("404.text")}</p>
        </div>
      );
    } else {
      return (
        <LoaderSpinner />
      );
    }
  }
}

export {NotFoundPage};
