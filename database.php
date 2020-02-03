<?php
$dbh = new \PDO('mysql:host=localhost;dbname=library_management', 'aboubacar', 'aboubacar');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if (!function_exists('insertInto')) {
    function insertInto($table, $data = [])
    {
        global $dbh;
        $columns = array_keys($data);
        $cp = implode(', ', array_map(function ($item) {
            return "`{$item}`";
        }, $columns));
        $cd = implode(', ', array_map(function ($item) {
            return ':' . $item;
        }, $columns));

        $stmt = $dbh->prepare("insert into $table ($cp) values ($cd)");

        if ($stmt->execute($data)) {
            return array_merge($data, ['id' => $dbh->lastInsertId()]);
        }

        return null;
    }
}
if (!function_exists('updateRow')) {
    function updateRow($table, $conditions, $data = [])
    {
        global $dbh;
        $columns = array_keys($data);

        $cd = implode(', ', array_map(function ($item) {
            return $item . '=:' . $item;
        }, $columns));

        $stmt = $dbh->prepare("update $table set $cd $conditions");

        if ($stmt->execute($data)) {
            return $data;
        }

        return false;
    }
}
if (!function_exists('select')) {
    function select($table, $fields = '', $wheres = [], $all = false)
    {
        global $dbh;
        $sql = "select {$fields} from {$table} ";
        if (!empty($wheres)) $sql .= "where $wheres[0] ";
        $stmt = $dbh->prepare($sql);
        $params = !empty($wheres) ? ($wheres[1] ?? []) : [];
        $stmt->execute($params);
        return $all ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if (!function_exists('sql_delete')) {
    function sql_delete($sql, $params = [])
    {
        global $dbh;
        $stmt = $dbh->prepare($sql);
        return $stmt->execute($params);
    }
}
if (!function_exists('selectWithSql')) {
    function selectWithSql($sql, $params = [], $all = false)
    {
        global $dbh;
        $stmt = $dbh->prepare($sql);
        $stmt->execute($params);
        return $all ? $stmt->fetchAll(PDO::FETCH_ASSOC) : $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
if (!function_exists('sqlCount')) {
    function sqlCount($sql, $params = [])
    {
        global $dbh;
        $stmt = $dbh->prepare($sql);
        $stmt->execute($params);
        return (int)$stmt->fetchColumn();
    }
}
if (!function_exists('selectWithPivot')) {
    function selectWithPivot($sql, $params, $relatedTable, $pivotTable, $localKey, $foreignKey)
    {
        $items = selectWithSql($sql, $params, true);
        $itemIds = (array_map(function ($item) {
            return $item['id'];
        }, $items));
        if (empty($items)) return [];
        $in = str_repeat('?,', count($items) - 1) . '?';

        $pivots = selectWithSql("select * from {$pivotTable} where {$localKey} in ($in)", $itemIds, true);
        $pivotIds = array_map(function ($item) use ($foreignKey) {
            return $item[$foreignKey];
        }, $pivots);

        if (empty($pivotIds)) {
            return array_map(function ($item) use ($foreignKey) {
                $item[$foreignKey] = [];
                return $item;
            }, $items);
        }

        $pivotIn = str_repeat('?,', count($pivotIds) - 1) . '?';
        $related = selectWithSql("select * from {$relatedTable} where id in($pivotIn)", $pivotIds, true);

        $data = [];

        foreach ($items as $item) {
            $datum = $item;

            $datum_pivots = array_filter($pivots, function ($pivot) use ($item, $localKey) {
                return $pivot[$localKey] === $item['id'];
            });

            $datum_pivots_id = array_map(function ($item) use ($foreignKey) {
                return $item[$foreignKey];
            }, $datum_pivots);

            $datum[$relatedTable] = array_filter($related, function ($item) use ($datum_pivots_id) {
                return in_array($item['id'], $datum_pivots_id);
            });

            array_push($data, $datum);
        }

        return $data;
    }
}


if (!function_exists('insertIfNotExists')) {
    function insertIfNotExists($table, $conditions, $values)
    {
        $item = select($table, '*', $conditions);
        if ($item) {
            return $item;
        }

        return insertInto($table, $values);
    }
}

if (!function_exists('admin_list_table')) {
    function admin_list_table($table, $searchColumns, $perPage = 15, $returnWithAllParams = false)
    {
        $sql = "select * from $table ";

        $currentPage = $_GET['page'] ?? 1;
        $sort_by = $_GET['sort_by'] ?? null;
        $sort_type = $_GET['sort_type'] ?? null;
        $query = $_GET['query'] ?? null;
        $action = $_GET['action'] ?? null;
        if ($action && $action == "delete") {
            if ($selected = ($_GET['selected'] ?? null)) {
                $ids = explode(",", $selected);
                $_ids = array_map(function ($id) {return '?';}, $ids);
                $_ids = implode(",", $_ids);
                if(sql_delete("delete from $table where id in ($_ids)", $ids)) {
//                    session_flash("success", "Les enregistrements selectionnés ont été supprimé");
                };
            }
        }
        $wheres = [];
        $params = [];
        if ($query) {
            $w = [];
            foreach ($searchColumns as $column) {
                $w[] = "lower($column) like ?";
                $params[] = "%" . strtolower($query) . "%";
            }
            $wheres[] = "(" . implode("or ", $w) . ")";
        }
        if (!empty($wheres)) {
            $sql .= " where " . implode('and ', $wheres);
        }
        if ($sort_by) {
            $sql .= " order by $sort_by ";
            if ($sort_type && in_array(strtolower($sort_type), ['desc', 'asc'])) $sql .= strtolower($sort_type);
        }
        $countSql = str_replace_first("select *", "select count(*)", $sql);
        $sql .= " limit $perPage ";
        if ($currentPage > 1) $sql .= " offset " . $perPage * ($currentPage - 1);
        $items = selectWithSql($sql, $params, true);
        $totals = sqlCount($countSql, $params);
        $totalPage = ceil($totals / $perPage);

        return $returnWithAllParams ? ['items' => $items, 'query' => $query, 'sort_by' => $sort_by, 'sort_type' => $sort_type, 'currentPage' => $currentPage, 'totalPage' => $totalPage] : $items;
    }
}
if (!function_exists('admin_list_table_with_sql')) {
    function admin_list_table_with_sql($sql, $params, $searchColumns, $perPage = 15, $returnWithAllParams = false, $concatWhere = false)
    {
        $currentPage = $_GET['page'] ?? 1;
        $sort_by = $_GET['sort_by'] ?? null;
        $sort_type = $_GET['sort_type'] ?? null;
        $query = $_GET['query'] ?? null;
        $wheres = [];
        if ($query) {
            $w = [];
            foreach ($searchColumns as $column) {
                $w[] = "lower($column) like ?";
                $params[] = "%" . strtolower($query) . "%";
            }
            $wheres[] = "(" . implode(" or ", $w) . ")";
        }
        if (!empty($wheres)) {
            $sql .= " " . ($concatWhere ? "and " : "where ") . implode('and ', $wheres);
        }
        if ($sort_by) {
            $sql .= " order by $sort_by ";
            if ($sort_type && in_array(strtolower($sort_type), ['desc', 'asc'])) $sql .= strtolower($sort_type);
        }
        $countSql = str_replace_first("select *", "select count(*) as c" . (strpos($sql, ',') ? ',' : ''), $sql);
        $sql .= " limit $perPage ";
        if ($currentPage > 1) $sql .= " offset " . $perPage * $currentPage;

        $items = selectWithSql($sql, $params, true);
        $totals = sqlCount($countSql, $params);
        $totalPage = ceil($totals / $perPage);

        return $returnWithAllParams ? ['items' => $items, 'query' => $query, 'sort_by' => $sort_by, 'sort_type' => $sort_type, 'currentPage' => $currentPage, 'totalPage' => $totalPage] : $items;
    }
}