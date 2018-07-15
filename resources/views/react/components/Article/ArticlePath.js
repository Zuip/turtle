import React from 'react';
import {Link} from 'react-router-dom';

class ArticlePath extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <span className="article-path">
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

export default ArticlePath;
