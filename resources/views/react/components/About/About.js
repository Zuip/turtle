import React from 'react';

import ArticleLayout from '../Layout/Grids/ArticleLayout';
import store from '../../store/store';

class About extends React.Component {
  render() {
    return (
      <ArticleLayout>

        <h1>{store.getState().translations.about.topic}</h1>

        <h2>{store.getState().translations.about.whatIsTurtleTravel.topic}</h2>
        <p>{store.getState().translations.about.whatIsTurtleTravel.text}</p>

        <h2>{store.getState().translations.about.whatDoWeMeanWithAuthenticity.topic}</h2>
        {
          store.getState().translations.about.whatDoWeMeanWithAuthenticity.text.map(paragraph => {
            return <p>{paragraph}</p>
          })
        }

        <h2>{store.getState().translations.about.whatIsOurGoal.topic}</h2>
        <p>
          {store.getState().translations.about.whatIsOurGoal.text}
          {
            store.getState().translations.about.whatIsOurGoal.goals.map(goal => {
              return <span><br />- {goal}</span>
            })
          }
        </p>

      </ArticleLayout>
    );
  }
}

export default About;
