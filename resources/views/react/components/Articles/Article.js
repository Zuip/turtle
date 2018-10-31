import React from 'react';
import { connect } from 'react-redux';
import { Helmet } from 'react-helmet';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import ArticlePath from './ArticlePath';
import ArticlePageChanger from './ArticlePageChanger';
import ArticleStyle from '../../style/components/Articles/Article';
import getArticle from '../../apiCalls/articles/getArticle';
import getArticleSummaryText from '../../services/articles/getArticleSummaryText';
import getArticleTitle from '../../services/articles/getArticleTitle';
import getArticleTranslations from '../../apiCalls/articles/getArticleTranslations';
import getNextArticle from '../../apiCalls/articles/getNextArticle';
import getPreviousArticle from '../../apiCalls/articles/getPreviousArticle';
import logError from '../../services/logError';
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

  componentWillReceiveProps(previousProps) {

    if(previousProps.translations.language !== this.props.translations.language) {
      
      this.loadArticleTranslations(
        previousProps.translations.language
      ).then(articleTranslations => {

        let articleTranslationFound = false;

        articleTranslations.map(
          articleTranslation => {
            if(articleTranslation.language === this.props.translations.language) {

              this.props.history.push(
                '/' + this.props.translations.routes.trips
                + '/' + this.props.match.params.tripURLName
                + '/' + this.props.match.params.countryUrlName
                + '/' + this.props.match.params.cityUrlName
                + '/' + this.props.match.params.cityVisitIndex
                + '/' + this.props.translations.routes.articles
              );

              articleTranslationFound = true;
            }
          }
        )

        if(!articleTranslationFound) {
          this.props.history.push(
            '/' + this.props.translations.routes.article + '/404'
          );
        }
      });

      return;
    }

    if(this.propsChanged(previousProps)) {
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
      error => logError(error, 'components/Articles/Article.js')
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

  loadArticleTranslations() {
    return getArticleTranslations(
      this.props.match.params.tripURLName,
      this.props.match.params.countryUrlName,
      this.props.match.params.cityUrlName,
      this.props.match.params.cityVisitIndex,
      this.props.translations.language
    );
  }

  render() {

    if(this.state.article === null) {
      return null;
    }

    return (
      <ArticleLayout>
        <Helmet>
          <title>
            {getArticleTitle(this.state.article)}
          </title>
          <meta
            name="description"
            content={getArticleSummaryText(this.state.article)}
          />
        </Helmet>
        <div className="article">
          <h2 style={ArticleStyle.h2}>
            {getArticleTitle(this.state.article)}
          </h2>
          <ArticlePath article={this.state.article} />
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
