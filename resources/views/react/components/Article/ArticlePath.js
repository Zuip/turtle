import React from 'react';
import {render} from 'react-dom';
import {Link} from 'react-router-dom';

import {Language} from '../../services/Language.js';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <span className="article-path">
        / {Language.getTranslation("trips.topic")}
        {
          this.props.pathArray.map(function(content) {
            return (
              <span key={content.URLName}> / <Link to={'/categories/' + content.URLName}>{content.name}</Link></span>
            );
          })
        }
      </span>
    );
  }
}

export {ArticlePath};
