# Database connection 
library('RPostgreSQL')
drv <- dbDriver("PostgreSQL")
con <- dbConnect(drv, dbname="<db_name>",host="<host_name>",
                 port=5432,user="<user_name>",
                 password="<password>" )
query <- "<sql_query>"
df <- dbGetQuery(con,query)



# Google sheets 
# 1. Would require rds 
# 2. Would require the key 
library(googlesheets)
suppressMessages(gs_auth(token = "<path_to_rds_file>/googlesheets_token.rds", verbose = FALSE))
ss <- gs_key("<google_sheet_key>")
ws <- gs_read(ss,ws="Sheet1")
head(ws)



# Send email using an SMTP server
library(mailR)
send.mail(from = "<from_email>",
          to = c("<to_email>"),          
          subject = paste('<subject_text>'),
          body = paste('<body_text>'),
          smtp = list(host.name = "smtp.gmail.com", port = 465,
                      user.name = "<username>",
                      passwd = "<password>", ssl = TRUE),
          attach.files = "<filename>" ,
          authenticate = TRUE,
          send = TRUE,html=TRUE,inline=TRUE)




# Upload files to aws bucket
library("aws.s3")
Sys.setenv("AWS_ACCESS_KEY_ID" = "<aws_access_key>",
           "AWS_SECRET_ACCESS_KEY" = "<aws_secret_access_key>",
           "AWS_DEFAULT_REGION" = 'ap-southeast-1')

l = get_bucket(
  bucket = '<bucket_name>',
  key = '<aws_access_key>',
  secret = '<aws_secret_access_key>',
  region = 'ap-southeast-1'
)
put_object(file = paste0("<file_path>",file_name)
           , object= paste0("<upload_to>",file_name)
           , bucket= "<bucket_name>")



# Upload files to aws bucket
library(httr)
r <- POST("<api_endpoint>",
          config = add_headers(access_token = "<api_access_token>",`Content-Type`="application/json"),
          body = list("link"=paste0("<link_to_file>",file_name)),encode="json")





