<?php // Earth911.com API Wrapper (PHP5)

class Earth911ApiError extends Exception {}

class Earth911Api {
    public function __construct($api_url, $api_key) {
        $this->api_url = $api_url;
        $this->api_key = $api_key;
    }

    public function __call($method, $args) {
        $args = $args ? $args[0] : array();
        $args['api_key'] = $this->api_key;
        $query = http_build_query($args);
        $url = $this->api_url . 'earth911.' . $method . '?' . $query;
        $result = json_decode(file_get_contents($url), true);
        if (isset($result['error'])) {
            throw new Earth911ApiError($result['error'], $result['code']);
        } else {
            return $result['result'];
        }
    }
}
?>
