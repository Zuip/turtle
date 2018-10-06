import React from 'react';
import { connect } from 'react-redux';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
 
class About extends React.Component {

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.props.history.push(
        '/' + this.props.translations.routes.about
      );
    }
  }

  render() {
    return (
      <ArticleLayout>

        <h1>{this.props.translations.about.topic}</h1>

        <h2>{this.props.translations.about.whatIsTurtleTravel.topic}</h2>
        <p>{this.props.translations.about.whatIsTurtleTravel.text}</p>

        <h2>{this.props.translations.about.whatDoWeMeanWithAuthenticity.topic}</h2>
        {
          this.props.translations.about.whatDoWeMeanWithAuthenticity.text.map(
            (paragraph,index) => (
              <p key={'authenticity_' + index}>{paragraph}</p>
            )
          )
        }

        <h2>{this.props.translations.about.whatIsOurGoal.topic}</h2>
        <p>
          {this.props.translations.about.whatIsOurGoal.text}
          {
            this.props.translations.about.whatIsOurGoal.goals.map(
              (goal, index) => (
                <span key={'goal_' + index}><br />- {goal}</span>
              )
            )
          }
        </p>

      </ArticleLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(About);
