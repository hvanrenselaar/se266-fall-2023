
<?php
    /*
        A two dimensional array in PHP is an array of arrays
    */
    
    
    $board = initialize_board (40, 150);
    
    $blinker_pattern = array (
        array (0, 1, 0),
        array (0, 1, 0),
        array (0, 1, 0)
    );

    $block_pattern = array (
        array (1,1),
        array (1,1)
    );
    
    $board = insert_pattern ($board, $blinker_pattern, 1, 1);
    $count = number_of_neighbors ($board, 0, 0);
    
  
    
    render_board ($board);
    function initialize_board ($number_of_rows, $number_of_columns) {
        $board_data = array();
        for ($row=0; $row<$number_of_rows; $row++) {
            $board_data[$row] = array();
            for ($col=0; $col<$number_of_columns; $col++) {
                $board_data[$row][$col] = 0;
            }
        }

        return $board_data;
    }

    function number_of_neighbors ($board, $x, $y) {
        $number_of_rows = count($board);
        $number_of_columns = count($board[0]);
        $count = 0;
        for ($row=$x-1; $row<=$y+1; $row++) {
            for ($col=$y-1; $col<=$y+1; $col++) {
                if ($row>=0 && $row<$number_of_rows && $col>=0 && $col<$number_of_columns && !($x==$row && $y==$col) && $board[$row][$col]) {
                    $count++;
                }
            }
        }
        return $count;
        
    }
    function insert_pattern ($data, $pattern, $x, $y) {
        $number_of_rows_in_pattern = count($pattern);
        $number_of_columns_in_pattern = count($pattern[0]);

        for ($row=0; $row<$number_of_rows_in_pattern; $row++) {
            for ($col=0; $col<$number_of_columns_in_pattern; $col++) {
                $data[$row+$y][$col+$x] = $pattern[$row][$col];
            }
        }
        return ($data);
    }
    function render_board ($data) {
        $number_of_rows = count($data);
        $number_of_columns = count($data[0]);
        $str= "";
        for ($row=0; $row<$number_of_rows; $row++) {
            for ($col=0; $col<$number_of_columns; $col++) {
                if ($data[$row][$col]) {
                    $str .= "X";
                } else {
                    $str .= "&nbsp;";
                }
            }
            $str .= "<br />";
        }
        echo $str;
    }
?>
