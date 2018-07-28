import React from 'react';
import TableStyle from '../../../../style/elements/Table';

class Row extends React.Component {

  constructor(props) {
    super(props);
  }

  render() {
    return (
      <tr style={TableStyle.row}>
        {this.props.row.cells.map((cell, index) => {
          return (
            <td key={"table_row_cell_" + index}>
              <p style={TableStyle.row.cell.p(this.props.position)}>
                {cell}
              </p>
            </td>
          );
        })}
      </tr>
    );
  }
}

export default Row;
