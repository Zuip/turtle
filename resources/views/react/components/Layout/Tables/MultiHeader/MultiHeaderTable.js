import React from 'react';

import Header from './Header';
import Row from './Row';
import TableStyle from '../../../../style/elements/Table';

class DefaultTable extends React.Component {

  constructor(props) {
    super(props);
  }

  getTableSectionContent(section, sectionIndex) {

    let sections = [];
    
    sections.push(
      <Header row={section.header}
              amountOfColumns={this.props.content.columns.amount}
              key={'table_section_' + sectionIndex + '_header'} />
    );

    section.rows.map((row, index) => {

      let position = null;

      if(index === 0) {
        position = 'first'
      }

      if(index + 1 === section.rows.length) {
        position = 'last'
      }

      sections.push(
        <Row row={row}
             position={position}
             key={'table_section_' + sectionIndex + '_row_' + index} />
      );
    });

    return sections;
  }

  combineSectionsInOneArray(sections) {

    if(sections.length === 0) {
      return [];
    }

    let combinedRows = sections[0];

    for(let i = 1; i < sections.length; ++i) {
      sections[i].map(row => {
        combinedRows.push(row);
      });
    }

    return combinedRows;
  }

  render() {

    if(this.props.content === null) {
      return null;
    }

    let rows = this.combineSectionsInOneArray(
      this.props.content.sections.map(
        (section, index) => this.getTableSectionContent(section, index)
      )
    );

    return (
      <table style={TableStyle}>
        <tbody>
          {rows}
        </tbody>
      </table>
    );
  }
}

export default DefaultTable;
