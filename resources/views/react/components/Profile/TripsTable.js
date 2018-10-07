import React from 'react';
import { connect } from 'react-redux';

import MultiHeaderTable from '../Layout/Tables/MultiHeader/MultiHeaderTable';

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

  getTripsTableData() {
    return {
      columns: {
        amount: 2
      },
      sections: this.props.trips.map(trip => {
        return {
          header: {
            cells: [trip.name]
          },
          rows: trip.visits.map(visit => {
            return {
              cells: [
                visit.city.name + ', ' + visit.city.country.name,
                null
              ]
            }
          })
        }
      })
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