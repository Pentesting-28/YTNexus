<?php

$url = "https://www.kickstarter.com/graph";

$headers = [
    "Accept: */*",
    "Accept-Language: en-US,en;q=0.9",
    "Content-Type: application/json",
    "Priority: u=1, i",
    "Sec-Ch-Ua: \"Opera GX\";v=\"116\", \"Chromium\";v=\"131\", \"Not_A Brand\";v=\"24\"",
    "Sec-Ch-Ua-Arch: \"x86\"",
    "Sec-Ch-Ua-Bitness: \"64\"",
    "Sec-Ch-Ua-Full-Version: \"116.0.5366.118\"",
    "Sec-Ch-Ua-Full-Version-List: \"Opera GX\";v=\"116.0.5366.118\", \"Chromium\";v=\"131.0.6778.266\", \"Not_A Brand\";v=\"24.0.0.0\"",
    "Sec-Ch-Ua-Mobile: ?0",
    "Sec-Ch-Ua-Model: \"\"",
    "Sec-Ch-Ua-Platform: \"Windows\"",
    "Sec-Ch-Ua-Platform-Version: \"19.0.0\"",
    "Sec-Fetch-Dest: empty",
    "Sec-Fetch-Mode: cors",
    "Sec-Fetch-Site: same-origin",
    "X-CSRF-Token: sBcUw15KzbLE9ihIAZGqnsD4y4mk6k2XKeRo6El5zfb2zdS0hypGmxfV8Xf4uYh0zC2Y0i2LokxGcffdLQfHlA",
    "Cookie: vis=7f2a6fbdb14efa67-7637689cc3aad2d8-63cbe6f9118c717cv1; optimizely_current_variations=%7B%7D; optimizelyEndUserId=oeu1731596984223r0.4849244953557921; ksr_consent=%7B%22purposes%22%3A%7B%22SaleOfInfo%22%3Atrue%7C%22Analytics%22%3Atrue%7C%22Functional%22%3Atrue%7C%22Advertising%22%3Atrue%7D%7C%22confirmed%22%3Atrue%7C%22prompted%22%3Atrue%7C%22timestamp%22%3A%222024-11-15T00%3A07%3A01.158Z%22%7C%22updated%22%3Atrue%7D",
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/116.0.0.0 Safari/537.36"
];

$body = '[{"operationName":"CommentsQuery","variables":{"commentableId":"UHJvamVjdC0xMTk4ODQ4Nzc1","nextCursor":null,"previousCursor":null,"first":25,"last":null},"query":"query CommentsQuery($commentableId: ID!, $nextCursor: String, $previousCursor: String, $replyCursor: String, $first: Int, $last: Int) {\\n  commentable: node(id: $commentableId) {\\n    id\\n    ... on Project {\\n      url\\n      __typename\\n    }\\n    ... on Commentable {\\n      canComment\\n      canCommentSansRestrictions\\n      commentsCount\\n      projectRelayId\\n      canUserRequestUpdate\\n      comments(\\n        first: $first\\n        last: $last\\n        after: $nextCursor\\n        before: $previousCursor\\n      ) {\\n        edges {\\n          node {\\n            ...CommentInfo\\n            ...CommentReplies\\n            __typename\\n          }\\n          __typename\\n        }\\n        pageInfo {\\n          startCursor\\n          hasNextPage\\n          hasPreviousPage\\n          endCursor\\n          __typename\\n        }\\n        __typename\\n      }\\n      __typename\\n    }\\n    __typename\\n  }\\n  me {\\n    id\\n    name\\n    imageUrl(width: 200)\\n    isKsrAdmin\\n    url\\n    isBlocked\\n    userRestrictions {\\n      restriction\\n      releaseAt\\n      __typename\\n    }\\n    __typename\\n  }\\n}\\n\\nfragment CommentInfo on Comment {\\n  id\\n  body\\n  createdAt\\n  parentId\\n  author {\\n    id\\n    imageUrl(width: 200)\\n    name\\n    url\\n    isBlocked\\n    __typename\\n  }\\n  removedPerGuidelines\\n  authorBadges\\n  canReport\\n  canDelete\\n  canPin\\n  hasFlaggings\\n  deletedAuthor\\n  deleted\\n  sustained\\n  pinnedAt\\n  authorCanceledPledge\\n  authorBacking {\\n    backingUrl\\n    id\\n    __typename\\n  }\\n  __typename\\n}\\n\\nfragment CommentReplies on Comment {\\n  replies(last: 3, before: $replyCursor) {\\n    totalCount\\n    nodes {\\n      ...CommentInfo\\n      __typename\\n    }\\n    pageInfo {\\n      startCursor\\n      hasPreviousPage\\n      __typename\\n    }\\n    __typename\\n  }\\n  __typename\\n}\"}]';

// Inicializar cURL
$ch = curl_init($url);

// Configurar opciones de cURL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_REFERER, "https://www.kickstarter.com/projects/ecoflow/ecoflow-delta-pro/comments");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

// Ejecutar la petición y obtener respuesta
$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// Manejo de errores
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
} else {
    echo "HTTP Code: $http_code\n";
    echo "Response:\n$response";
}

// Cerrar la conexión cURL
curl_close($ch);
