import React from 'react';
import { connect } from 'react-redux';
import { Link } from 'react-router-dom';

import MultiHeaderTable from '../Layout/Tables/MultiHeader/MultiHeaderTable';

import getCityPath from '../../services/paths/getCityPath';
import getCountryPath from '../../services/paths/getCountryPath';

class TripsTable extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      table: {
        columns: {
          amount: 2
        },
        sections: []
      }
    };
  }

  getCityLink(visit) {

    let cityPath = getCityPath(
      visit.city.country,
      visit.city,
      this.props.translations
    );

    return (
      <Link to={cityPath}>
        {visit.city.name}
      </Link>
    );
  }

  getCountryLink(visit) {

    let countryPath = getCountryPath(
      visit.city.country,
      this.props.translations
    );

    return (
      <Link to={countryPath}>
        {visit.city.country.name}
      </Link>
    );
  }

  getNameCell(visit) {

    let cityLink = this.getCityLink(visit);
    let countryLink = this.getCountryLink(visit);

    return (
      <span>
        {cityLink}, {countryLink}
      </span>
    );
  }

  getTripsTableData() {
    return {
      columns: {
        amount: 2
      },
      sections: this.props.trips.map(
        trip => ({
          header: {
            cells: [trip.name]
          },
          rows: trip.visits.map(
            visit => ({
              cells: [
                this.getNameCell(visit),
                null
              ]
            })
          )
        })
      )
    };
  }

  render() {

    let table = this.getTripsTableData();

    return (
      <div>
        <h3>{this.props.translations.profile.trips}</h3>
        <div style={{ padding: '10px' }}>
          <MultiHeaderTable content={table} />
        </div>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(TripsTable);