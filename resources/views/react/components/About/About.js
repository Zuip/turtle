import React from 'react';

import Language from '../../services/Language.js';
import VisitedPlacesMap from './VisitedPlacesMap.js';
import LoaderSpinner from '../LoaderSpinner.js';

class About extends React.Component {

  componentDidMount() {
    Language.init(this);
  }

  render() {
    if(Language.initialized) {
      return (
        <div>
          <h1>{Language.getTranslation("about.topic")}</h1>
          <p>{Language.getTranslation("about.aboutWriter")}</p>
          <h3>{Language.getTranslation("about.contact")}</h3>
          <p>{Language.getTranslation("about.contactInfo")}</p>
          <p>{Language.getTranslation("about.contactEmail")}</p>
          <h3>{Language.getTranslation("about.placesVisited")}</h3>
          <VisitedPlacesMap />
        </div>
      );
    } else {
      return (
        <LoaderSpinner />
      );
    }
  }
}

export default About;
