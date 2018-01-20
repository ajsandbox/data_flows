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


print("Accessing Google Sheet")
library(googlesheets)
if(file.exists("<path_to_rds_file>/Googlefiles.rds")) {
  print("Using existing token...")
  token<-gs_auth(token="<path_to_rds_file>/Googlefiles.rds")
} else{
  print("Generating missing token...")
  token<-gs_auth()
  gd_token()
  saveRDS(token, file="<path_to_rds_file>/Googlefiles.rds")}
s1<-gs_url("<link_to_googlesheet>/edit#gid=0", verbose = TRUE)
x5=gs_read(s1,ws="<worksheet>",range="B1:G8000",col_names=TRUE)
l<-data.frame(x5)
l$date<-as.character(l$date)
l[is.na(l)]<-0
## code to clear data in googlesheet 
for (i in seq(from=1,to=nrow(l),by=1))                      
{
  for(j in seq(from=1,to=ncol(l),by=1))
  {
    l[i,j]<-""
    
  }
}
gs_edit_cells(s1, ws = "<worksheet>", input = l, anchor = "B2", byrow = FALSE,
              col_names = FALSE, verbose = TRUE)
gs_edit_cells(s1, ws = "<worksheet>", input = <dbquery_result>, anchor = "B2", byrow = FALSE,
              col_names = FALSE, verbose = TRUE)

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



# Send a message to slack 
# https://github.com/hrbrmstr/slackr


# list of libraries
library(RPostgreSQL, warn.conflicts = FALSE, quietly=TRUE)
library(ggplot2, warn.conflicts = FALSE, quietly=TRUE)
library(scales, warn.conflicts = FALSE, quietly=TRUE)
library(ggrepel, warn.conflicts = FALSE, quietly=TRUE)
library(dplyr, warn.conflicts = FALSE, quietly=TRUE)
library(doBy, warn.conflicts = FALSE, quietly=TRUE)
library(xtable, warn.conflicts = FALSE, quietly=TRUE)
library(mailR, warn.conflicts = FALSE, quietly=TRUE)
library (syuzhet, warn.conflicts = FALSE, quietly=TRUE)



