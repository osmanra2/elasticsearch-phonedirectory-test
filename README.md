# elasticsearch-phonedirectory-test
just testing elasticsearch with a simple phone directory

This is a test using elasticsearch and showing it is real-time indexing strength

First install elasticsearch https://www.elastic.co/downloads/elasticsearch 

edit your elasticsearch.yml file and rename your cluster and node to something that is suitiable for you. ex:xxx-dev-cluster

Get this PHP Client https://github.com/elastic/elasticsearch-php 

navigate to localhost or 127.0.0.1:9200 and setup your index

Below is the way I set mine up. 

PUT employee/
{
  "mappings" : {
    "user" : {
      "properties" : {
        "name" : {
          "type" : "string",
          "search_analyzer" : "str_search_analyzer",
          "index_analyzer" : "str_index_analyzer"
        },
        "employee_number" : {
          "type" : "string",
          "search_analyzer" : "str_search_analyzer",
          "index_analyzer" : "str_index_analyzer"
        },
        "date_of_hire" : {
          "type" : "string",
          "search_analyzer" : "str_search_analyzer",
          "index_analyzer" : "str_index_analyzer"
        }
      }
    }
  },

  "settings" : {
    "analysis" : {
      "analyzer" : {
        "str_search_analyzer" : {
          "tokenizer" : "keyword",
          "filter" : ["lowercase"]
        },

        "str_index_analyzer" : {
          "tokenizer" : "keyword",
          "filter" : ["lowercase", "substring"]
        }
      },

      "filter" : {
        "substring" : {
          "type" : "nGram",
          "min_gram" : 1,
          "max_gram"  : 20
        }
      }
    }
  }
}

this allows you to search all fields. 

Using the add.php file you can instantly add documents into the index. 

Read more here:
https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/index.html
Video Tutorial here and Credit to Elastic Youtube Channel and Codecouse:
https://www.youtube.com/watch?v=XCHYo0CsZrk --- Elastic Channel
https://www.youtube.com/watch?v=3xb1dHLg-Lk --- Codecourse Channel
