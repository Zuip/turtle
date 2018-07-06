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
      <div className="load-more-articles">
        <button className="form-control"
                onClick={this.props.loadNextArticles}>

          {store.getState().translations.frontPage.loadMoreArticles}

        </button>
      </div>
    );
  }
}

export default LoadMoreArticlesButton;
