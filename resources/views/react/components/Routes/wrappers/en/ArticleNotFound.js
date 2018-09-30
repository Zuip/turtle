import React from 'react';

import TranslationNotFound from '../../../Articles/TranslationNotFound';
import setLanguage from '../../../../services/setLanguage';
import setTitle from '../../../../services/setTitle';

class ArticleNotFoundRouteWrapper extends React.Component {

  constructor(props) {
    super(props);
    setLanguage('en');
  }

  componentDidMount() {
    setTitle();
  }

  render() {
    return (
      <TranslationNotFound match={this.props.match} history={this.props.history} />
    );
  }
}

export default ArticleNotFoundRouteWrapper;