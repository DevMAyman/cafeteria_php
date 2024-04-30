<?php
require_once "db_connection.php"; 

class Pagination {
    private $recordsPerPage;
    private $currentPage;
    private $tableName;

    public function __construct($recordsPerPage, $currentPage, $tableName) {
        $this->recordsPerPage = $recordsPerPage;
        $this->currentPage = $currentPage;
        $this->tableName = $tableName;
    }

    public function render() {
        $totalRecords = $this->getTotalRecords();
        $totalPages = ceil($totalRecords / $this->recordsPerPage);
        $paginationHTML = '<ul class="pagination">';

        // Previous page link
        if ($this->currentPage > 1) {
            $previousPage = $this->currentPage - 1;
            $paginationHTML .= '<li><a href="?table=' . $this->tableName . '&page=' . $previousPage . '">Previous</a></li>';
        }

        // Page links
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $this->currentPage) {
                $paginationHTML .= '<li class="active"><span>' . $i . '</span></li>';
            } else {
                $paginationHTML .= '<li><a href="?table=' . $this->tableName . '&page=' . $i . '">' . $i . '</a></li>';
            }
        }

        // Next page link
        if ($this->currentPage < $totalPages) {
            $nextPage = $this->currentPage + 1;
            $paginationHTML .= '<li><a href="?table=' . $this->tableName . '&page=' . $nextPage . '">Next</a></li>';
        }

        $paginationHTML .= '</ul>';

        return $paginationHTML;
    }

    private function getTotalRecords() {
        $conn = new Database(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $conn->connectToDatabase();

        $query = "SELECT COUNT(*) AS total FROM " . $this->tableName;
        $stmt = $conn->getPdo()->query($query);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['total'];
    }
}
?>
