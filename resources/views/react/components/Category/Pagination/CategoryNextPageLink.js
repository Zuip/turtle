import React from 'react';
import { Link } from 'react-router-dom';

class CategoryNextPageLink extends React.Component {

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

    if(parseInt(this.props.currentPage) === this.props.amountOfPages) {
      return null;
    }

    let nextPageNumber = parseInt(this.props.currentPage) + 1;

    let link = '/categories/' + this.props.categoryURLName
             + '/pages/' + nextPageNumber;

    return (
      <li className="page-item">
        <Link className="page-link" to={link}>
          <i className="fa fa-chevron-right" aria-hidden="true"></i>
        </Link>
      </li>
    );
  }
}

export default CategoryNextPageLink;
