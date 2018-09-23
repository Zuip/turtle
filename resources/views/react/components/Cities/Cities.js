import React from 'react';
import { connect } from 'react-redux';

import BaseLayout from '../Layout/Grids/BaseLayout';
import LeftBarLayout from '../Layout/Grids/LeftBarLayout';
import FirstColumn from '../Layout/Grids/FirstColumn';
import SecondColumn from '../Layout/Grids/SecondColumn';

import CitiesList from './src/CitiesList';
import CitiesStyle from '../../style/components/Cities/Cities';
import CitySearch from './src/CitySearch';

class Cities extends React.Component {

  constructor(props) {
    super(props);
    this.state = {
      filter: {
        country: null
      }
    }
  }

  filterUpdated(filter) {
    this.setState({ filter });
  }

  componentDidUpdate(previousProps) {
    if(previousProps.translations.language !== this.props.translations.language) {
      this.props.history.push(
        '/' + this.props.translations.routes.cities
      );
    }
  }

  render() {
    return (
      <LeftBarLayout useFullHeight={true}>
        <FirstColumn>
          <div style={CitiesStyle.getLeftBarStyle()}>
            <BaseLayout>
              <CitySearch filterUpdated={this.filterUpdated.bind(this)}/>
            </BaseLayout>
          </div>
        </FirstColumn>
        <SecondColumn>
          <div style={CitiesStyle.getContentColumnStyle()}>
            <CitiesList filter={this.state.filter} />
          </div>
        </SecondColumn>
      </LeftBarLayout>
    );
  }
}

export default connect(
  state => ({ translations: state.translations })
)(Cities);