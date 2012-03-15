<?php

class SearchArgs {
    function SearchArgs($request, $api) {
        $this->what = isset($request['what']) ? $request['what'] : '';
        $this->where = isset($request['where']) ? $request['where'] : '';

        $this->foundWhere = false;
        $this->latitude = null;
        $this->longitude = null;

        if ($this->where) {
            $args = array('postal_code' => $this->where, 'country' => 'US');
            $postal = null;
            try {
                $postal = $api->getPostalData($args);
                $this->foundWhere = true;
            } catch (Earth911_ApiError $e) { }

            if ($postal) {
                $this->latitude = $postal['latitude'];
                $this->longitude = $postal['longitude'];
            }
        }
    }

    function queryString() {
        return 'what=' . urlencode($this->what) . '&where=' . urlencode($this->where);
    }
}

class SearchPager {
    function SearchPager($list, $page=1, $size=10) {
        $this->list = $list;
        $this->size = $size;
        $this->page = $this->bound(intval($page ? $page : 1));
    }

    function total() {
        return floor((count($this->list) - 1) / $this->size) + 1;
    }

    function bound($page) {
        return max(1, min(intval($page), $this->total()));
    }

    function result($page=null) {
        if (!$page) $page = $this->page;
        return array_slice($this->list, ($page - 1) * $this->size, $this->size);
    }

    function nav($page=null) {
        if (!$page) $page = $this->page;

        $total = $this->total();
        $prev  = max(1, $page - 1);
        $prevc = count($this->result($prev));
        $next  = min($page + 1, $total);
        $nextc = count($this->result($next));

        return array(
            'page'  => $page,
            'total' => $total,
            'prev'  => $prev,
            'prevc' => $prevc,
            'next'  => $next,
            'nextc' => $nextc,
        );
    }

    function window($width=20, $page=null) {
        if (!$page) $page = $this->page;

        $total = $this->total();

        $before = array();
        $after = array();

        for ($i = 1; $i <= $total; $i++) {
            if (($page - $i) < ($width / 2) && ($i - $page) < ($width / 2)) {
                if ($i < $page) {
                    $before[] = $i;
                } else if ($i > $page) {
                    $after[] = $i;
                }
            }
        }

        return array('before' => $before, 'after' => $after);
    }
}

?>
