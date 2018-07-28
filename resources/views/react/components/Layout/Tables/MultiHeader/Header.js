import React from 'react';
import TableStyle from '../../../../style/elements/Table';

class Header extends React.Component {

  constructor(props) {
    super(props);
  }

  getColspan(isFirstColumn) {

    if(!isFirstColumn) {
      return 1;
    }

    return this.props.amountOfColumns
           - this.props.row.cells.length
           + 1;
  }

  render() {

    let isFirstColumn = true;

    return (
      <tr style={TableStyle.header.row}>
        {this.props.row.cells.map((cell, index) => {

          let colspan = this.getColspan(isFirstColumn);
          isFirstColumn = false;

          return (
            <td key={"table_header_cell_" + index} colSpan={colspan}>
              <h4 style={TableStyle.header.row.cell.h4}>{cell}</h4>
            </td>
          );
        })}
      </tr>
    );
  }
}

export default Header;
