<?php
/**
 * @param $url
 * @param null $removeParamValue
 * @param string $addParam
 * @param bool $sortFlag
 * @return string
 */
function  formationUrl($url, $removeParamValue = null, $addParam  = '', $sortFlag = false) {
    if (!empty($url)) {
        $parseUrl = parse_url($url);

        if (!is_null($removeParamValue)) {
            $resultQuery = removeUrlParam($parseUrl['query'], $removeParamValue);
        } else {
            parse_str($parseUrl['query'], $resultQuery);
        }

        if ($sortFlag) {
            asort($resultQuery);
        }

        if (!empty($addParam)) {
            $resultQuery['url'] = $addParam;
        }

        return  genUrlAddress($parseUrl['host'], $parseUrl['scheme'], '', http_build_query($resultQuery));
    }

    return 'Empty URL!';
}

/**
 * @param $queryUrl
 * @param null $valueParam
 * @return array
 */
function removeUrlParam($queryUrl, $valueParam = null) {
    parse_str($queryUrl, $queryArr);
    return array_filter($queryArr, function ($item) use ($valueParam) {
        return (int)$item !== $valueParam;
    });
}

/**
 * @param $host
 * @param string $protocol
 * @param string $path
 * @param string $query
 * @return string
 */
function genUrlAddress($host, $protocol = 'http', $path = '', $query = '') {
    return $protocol .'://'. $host .'/'. $path .'?'. $query;
}

echo formationUrl(
    'https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3',
    3,
    '/test/index.html',
    true);
