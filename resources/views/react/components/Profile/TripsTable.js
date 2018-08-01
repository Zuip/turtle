import React from 'react';
import { connect } from 'react-redux';

import getUserTrips from '../../apiCalls/getUserTrips';
import MultiHeaderTable from '../Layout/Tables/MultiHeader/MultiHeaderTable';
import pageSpinner from '../../services/pageSpinner';

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

  componentDidMount() {
    this.loadTrips();
  }

  updateTripsTable(trips) {
    this.setState({
      table: {
        columns: {
          amount: 2
        },
        sections: trips.map(trip => {
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
      }
    });
  }

  loadTrips() {

    pageSpinner.start('article');

    getUserTrips(
      this.props.user.id,
      this.props.translations.languageCode
    ).then(
      trips => trips.filter(trip => trip.visits.length)
    ).then(trips => {
      this.updateTripsTable(trips);
      pageSpinner.finish('article');
    }).catch(error => {
      console.log(error);
    });
  }

  render() {
    return (
      <div>
        <h3>{this.props.translations.profile.trips}</h3>
        <div style={{ padding: '10px' }}>
          <MultiHeaderTable content={this.state.table} />
        </div>
      </div>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(TripsTable);