import React from 'react';

import store from '../../store/store';

class LoadMoreArticlesButton extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    if(this.props.allArticlesLoaded) {
      return null;
    }

    return (
      <p>
        <button className="btn btn-primary load-more-articles-button"
                onClick={this.props.loadNextArticles}>

          {store.getState().translations.frontPage.loadMoreArticles}

        </button>
      </p>
    );
  }
}

export default LoadMoreArticlesButton;
