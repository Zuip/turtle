/* This file is still work in progress */

class AdminArticle extends React.Component {
  render() {
    return (
      <div class="page-header">
        <h1>{Language.translations.admin.article.topic}</h1>
        <AdminArticlePath />
      </div>
    );
  }
}

class AdminArticlePath extends React.Component {
  render() {
    return (
      <strong>{Language.translations.common.path}:</strong>
    );
  }
}

ReactDOM.render(
  <AdminArticle />,
  document.getElementById('AdminArticleView')
);
