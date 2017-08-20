import React from 'react';
import {render} from 'react-dom';

import {CategoryPageLink} from './CategoryPageLink.js';
import {CategoryPreviousPageLink} from './CategoryPreviousPageLink.js';
import {CategoryNextPageLink} from './CategoryNextPageLink.js';

class Pagination extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      pages: [],
      amountOfPages: 0
    }
  }

  componentDidMount() {
    this.setState({
      pages: this.getPages()
    });
  }

  componentWillReceiveProps(newProps) {
    if(newProps.categoryURLName !== this.props.categoryURLName) {
      this.props = newProps;
      this.setState({
        pages: this.getPages()
      });
    }
  }

  getPages() {

    let pages = [];
    this.state.amountOfPages = Math.ceil(this.props.amountOfArticles / 10);

    for(let i = 0; i < this.state.amountOfPages; ++i) {
      pages.push(i + 1);
    }

    return pages;
  }

  render() {

    if(this.state.amountOfPages === 1) {
      return null;
    }

    let categoryURLName = this.props.categoryURLName;
    let currentPage = this.props.currentPage;

    return (
      <nav className="clearfix">
        <ul className="pagination">

          <CategoryPreviousPageLink categoryURLName={categoryURLName}
                                    currentPage={currentPage}
                                    amountOfPages={this.state.amountOfPages} />

          {
            this.state.pages.map(function(page) {
              return (
                <CategoryPageLink categoryURLName={categoryURLName}
                                  page={page}
                                  currentPage={currentPage}
                                  key={page} />
              );
            })
          }

          <CategoryNextPageLink categoryURLName={categoryURLName}
                                currentPage={currentPage}
                                amountOfPages={this.state.amountOfPages} />
        </ul>
      </nav>
    );
  }
}

export {Pagination};
