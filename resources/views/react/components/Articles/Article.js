import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import ArticlePath from './ArticlePath';
import ArticlePageChanger from './ArticlePageChanger';
import getArticle from '../../apiCalls/getArticle';
import getNextArticle from '../../apiCalls/getNextArticle';
import getPreviousArticle from '../../apiCalls/getPreviousArticle';
import pageSpinner from '../../services/pageSpinner';

class Article extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      article: null,
      nextArticle: null,
      previousArticle: null
    }
  }

  componentDidMount() {
    this.loadArticleParts();
  }

  componentWillReceiveProps(newProps) {
    if(this.propsChanged(newProps)) {
      this.setState({
        article: null
      }, () => {
        this.loadArticleParts()
      });
    }
  }

  loadArticleParts() {

    pageSpinner.start('Article');

    Promise.all([
      this.loadArticle(),
      this.loadPreviousArticle(),
      this.loadNextArticle()
    ]).then(data => {

      this.setState({
        article: data[0],
        previousArticle: data[1],
        nextArticle: data[2]
      });

      pageSpinner.finish('Article');

    }).catch(
      error => console.log(error)
    );
  }

  propsChanged(newProps) {
    return newProps.match.params.tripUrlName !== this.props.match.params.tripURLName
        || newProps.match.params.countryUrlName !== this.props.match.params.countryUrlName
        || newProps.match.params.cityUrlName !== this.props.match.params.cityUrlName;
  }

  loadArticle() {
    return getArticle(
      this.props.match.params.tripURLName,
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.match.params.cityVisitIndex,
      this.props.translations.language
    );
  }

  loadPreviousArticle() {
    return getPreviousArticle(
      this.props.match.params.tripURLName,
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.match.params.cityVisitIndex,
      this.props.translations.language
    ).catch(
      () => null
    );
  }

  loadNextArticle() {
    return getNextArticle(
      this.props.match.params.tripURLName,
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.match.params.cityVisitIndex,
      this.props.translations.language
    ).catch(
      () => null
    );
  }

  render() {

    if(this.state.article === null) {
      return null;
    }

    return (
      <ArticleLayout>
        <div className="article">
          <h3>{this.state.article.city.name}, {this.state.article.city.country.name}</h3>
          <h5>{this.state.article.publishTime}, <ArticlePath article={this.state.article} /></h5>
          <div className="summary" dangerouslySetInnerHTML={{__html: this.state.article.summary}}></div>
          <div dangerouslySetInnerHTML={{__html: this.state.article.text}}></div>
          <ArticlePageChanger previousArticle={this.state.previousArticle} nextArticle={this.state.nextArticle} />
        </div>
      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Article);
