import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import CitiesStyle from '../../../style/components/Cities';

class CitiesList extends React.Component {

  constructor(props) {
    super(props);
  }

  getCityLink() {
    return '/countries/' + this.props.city.country.urlName
         + '/cities/' + this.props.city.urlName
  }

  render() {
    return (
      <Link to={this.getCityLink()} 
            style={CitiesStyle.getBoxStyle()}>

        <h4>
          {this.props.city.name}
          , {this.props.city.country.name}
        </h4>

      </Link>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CitiesList);