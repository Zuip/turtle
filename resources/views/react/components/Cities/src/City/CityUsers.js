import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import CityStyle from '../../../../style/components/Cities/City';
import getCityUsers from '../../../../apiCalls/cities/getCityUsers';
import getUserPath from '../../../../services/paths/getUserPath';
import MultiHeaderTable from '../../../Layout/Tables/MultiHeader/MultiHeaderTable';
import pageSpinner from '../../../../services/pageSpinner';

class CityUsers extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      cityUsers: []
    };
  }

  componentDidMount() {
    this.loadCityUsers();
  }

  loadCityUsers() {

    pageSpinner.start('City users');

    getCityUsers(
      this.props.city.country.urlName,
      this.props.city.urlName,
      this.props.translations.language
    ).then(cityUsers => {
      this.setState({ cityUsers });
      pageSpinner.finish('City users');
    }).catch((error) => {
      console.error(error);
    });
  }

  getUsersTableData() {
    return {
      columns: {
        amount: 2
      },
      sections: [
        {
          header: {
            cells: [this.props.translations.cities.usersVisitedInCity]
          },
          rows: this.state.cityUsers.map(
            user => ({
              cells: [
                <Link to={getUserPath(user, this.props.translations)}>
                  {user.name}
                </Link>,
                null
              ]
            })
          )
        }
      ]
    };
  }

  render() {

    if(this.state.cityUsers === null) {
      return null;
    }

    if(this.state.cityUsers.length === 0) {
      return null;
    }

    return (
      <div style={CityStyle.cityUsers}>
        <MultiHeaderTable content={this.getUsersTableData()} />
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(CityUsers);