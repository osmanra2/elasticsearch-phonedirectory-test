# elasticsearch-phonedirectory-test
just testing elasticsearch with a simple phone directory

<p>This is a test using elasticsearch and showing it is real-time indexing strength</p>

<p>First install elasticsearch https://www.elastic.co/downloads/elasticsearch</p> 

<p>edit your elasticsearch.yml file and rename your cluster and node to something that is suitiable for you. ex:xxx-dev-cluster</p>

<p>Get this PHP Client https://github.com/elastic/elasticsearch-php </p>

<p>navigate to localhost or 127.0.0.1:9200 and setup your index</p>
<p>be sure to install marvel also, documentation is here : https://www.elastic.co/downloads/marvel</p>

<p>Below is the way I set mine up. </p>

PUT employee/
<pre>{
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
</pre>
<p>this allows you to search all fields. </p>

<p>Using the add.php file you can instantly add documents into the index. </p>

<p>Read more here:<br /><br />
https://www.elastic.co/guide/en/elasticsearch/client/php-api/2.0/index.html<br /><br />
Video Tutorial here and Credit to Elastic Youtube Channel and Codecouse:<br /><br />
https://www.youtube.com/watch?v=XCHYo0CsZrk --- Elastic Channel<br /><br />
https://www.youtube.com/watch?v=3xb1dHLg-Lk --- Codecourse Channel<br /><br />
http://mnylen.tumblr.com/post/22963609412/elasticsearch-and-a-simple-contains-search<br /><br />
</p>
