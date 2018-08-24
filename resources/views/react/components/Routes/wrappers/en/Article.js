import React from 'react';

import Article from '../../../Articles/Article';
import setLanguage from '../../../../services/setLanguage';

class ArticleRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  render() {
    return (
      <Article match={this.props.match} history={this.props.history} />
    );
  }
}

export default ArticleRouteWrapper;