import React from 'react';
import {render} from 'react-dom';

import {Category} from './Category.js';

class CategoryFirstPage extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {

    this.props.match.page = 1;

    return (
      <Category match={this.props.match}/>
    );
  }
}

export {CategoryFirstPage};
