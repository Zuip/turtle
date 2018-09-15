import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import ArticlePath from './ArticlePath';
import ArticlePageChanger from './ArticlePageChanger';
import BaseLayout from '../Layout/Grids/BaseLayout';
import formatVisitDates from '../../services/trips/visits/formatVisitDates';
import getArticle from '../../apiCalls/getArticle';
import getNextArticle from '../../apiCalls/getNextArticle';
import getPreviousArticle from '../../apiCalls/getPreviousArticle';
import getArticleTranslations from '../../apiCalls/articles/getArticleTranslations';
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

  getVisitDates() {
    return formatVisitDates(
      this.state.article.visit.start,
      this.state.article.visit.end
    );
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
      <BaseLayout>
        <ArticleLayout>
          <div className="article">
            <h3>{this.state.article.city.name}, {this.state.article.city.country.name}, {this.getVisitDates()}</h3>
            <ArticlePath article={this.state.article} />
            <div className="summary" dangerouslySetInnerHTML={{__html: this.state.article.summary}}></div>
            <div dangerouslySetInnerHTML={{__html: this.state.article.text}}></div>
            <ArticlePageChanger previousArticle={this.state.previousArticle} nextArticle={this.state.nextArticle} />
          </div>
        </ArticleLayout>
      </BaseLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Article);
