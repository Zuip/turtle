import React from 'react';

class ArticleLayout extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <div className="article-grid-container">
        <div className="grid-column">
          {this.props.children}
        </div>
      </div>
    );
  }
}

export default ArticleLayout;