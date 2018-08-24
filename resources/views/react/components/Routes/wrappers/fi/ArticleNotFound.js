import React from 'react';

import TranslationNotFound from '../../../Articles/TranslationNotFound';
import setLanguage from '../../../../services/setLanguage';

class ArticleNotFoundRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('fi');
  }

  render() {
    return (
      <TranslationNotFound match={this.props.match} history={this.props.history} />
    );
  }
}

export default ArticleNotFoundRouteWrapper;