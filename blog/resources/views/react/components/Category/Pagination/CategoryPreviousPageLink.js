import React from 'react';
import {render} from 'react-dom';
import {Link} from 'react-router-dom';

class CategoryPreviousPageLink extends React.Component {

  constructor(props) {
    super(props);
  }

  componentWillReceiveProps(props) {

    let pageChanged = function(oldProps, newProps) {

      if(newProps.categoryURLName !== oldProps.categoryURLName) {
        return true;
      }

      if(newProps.currentPage !== oldProps.currentPage) {
        return true;
      }

      return false;
    }

    if(pageChanged(this.props, props)) {
      this.props = props;
      this.forceUpdate();
    }
  }

  render() {

    if(parseInt(this.props.currentPage) === 1) {
      return null;
    }

    let previousPageNumber = parseInt(this.props.currentPage) - 1;

    let link = '/categories/' + this.props.categoryURLName
             + '/pages/' + previousPageNumber;

    return (
      <li className="page-item">
        <Link className="page-link" to={link}>
          <i className="fa fa-chevron-left" aria-hidden="true"></i>
        </Link>
      </li>
    );
  }
}

export {CategoryPreviousPageLink};
