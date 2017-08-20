import React from 'react';
import {render} from 'react-dom';
import {Link} from 'react-router-dom';

class CategoryPageLink extends React.Component {

  constructor(props) {
    super(props);
  }

  componentWillReceiveProps(newProps) {

    if(newProps.categoryURLName === this.props.categoryURLName) {
      return;
    }

    if(newProps.page === this.props.page) {
      return;
    }

    this.props = newProps;
    this.forceUpdate();
  }

  render() {

    let link = '/categories/' + this.props.categoryURLName
             + '/pages/' + this.props.page;

    if(this.props.page === parseInt(this.props.currentPage)) {
      return (
        <li className="page-item active">
          <Link className="page-link" to={link}>
            {this.props.page}
          </Link>
        </li>
      );
    }

    return (
      <li className="page-item">
        <Link className="page-link" to={link}>
          {this.props.page}
        </Link>
      </li>
    );
  }
}

export {CategoryPageLink};
