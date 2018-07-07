import React from 'react';

import store from '../../store/store';

class About extends React.Component {
  render() {
    return (
      <div>

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

      </div>
    );
  }
}

export default About;
