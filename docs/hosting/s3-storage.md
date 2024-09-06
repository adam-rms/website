---
sidebar_position: 10
title: File & Image Storage
---

Images and files are stored using an [AWS S3 Bucket](https://aws.amazon.com/s3/), which can either be from Amazon, or from a service such as [Backblaze](https://www.backblaze.com/). Most of the environment variables should be provided when you set up the storage bucket.

#### BackBlaze B2

BackBlaze is a cloud storage service which provides S3-compatible object storage.

##### Bucket Info

Set the bucket info to:

```
{"cache-control":"public, max-age=900, s-maxage=3600, stale-while-revalidate=900, stale-if-error=3600"}
```

##### Bucket CORS

You need to setup the CORS on the bucket to allow uploads

1. Download and authenticate the [AWS Cli](https://aws.amazon.com/cli/) (using your Backblaze credentials).
2. Create a file called `cors.json` file, and add the following the information:

```json
{
  "CORSRules": [
    {
      "AllowedHeaders": ["*"],
      "AllowedMethods": ["POST", "PUT", "GET", "HEAD"],
      "AllowedOrigins": ["*"],
      "ExposeHeaders": [
        "etag",
        "x-bz-content-sha1",
        "x-amz-meta-qqfilename",
        "x-amz-meta-size",
        "x-amz-meta-subtype",
        "x-amz-meta-typeid",
        "authorization",
        "content-type",
        "origin",
        "x-amz-acl",
        "x-amz-content-sha256",
        "x-amz-date",
        "range",
        "Access-Control-Allow-Origin"
      ],
      "MaxAgeSeconds": 86400
    }
  ]
}
```

3. Run the following command to apply the policy to your new bucket:

```sh
aws s3api put-bucket-cors --bucket=<BUCKETNAME> --endpoint-url=https://s3.eu-central-003.backblazeb2.com --cors-configuration=file://backblaze-cors.json
```

Then set the following environment variables

```
bCMS__AWS_S3_BUCKET_REGION=eu-central-003
bCMS__AWS_S3_BUCKET_NAME=<BUCKETNAME>
bCMS__AWS_SERVER_KEY=00xxxxx00
bCMS__AWS_SERVER_SECRET_KEY=K0000000000000/0000000000000
bCMS__AWS_S3_CDN=https://s3.eu-central-003.backblazeb2.com/<BUCKETNAME>
bCMS__AWS_S3_BUCKET_ENDPOINT=s3.eu-central-003.backblazeb2.com
```

#### AWS S3

To use AWS S3 you need two IAM users.

##### File S3 Bucket

Create an S3 Bucket, with the follwing Policy

```
{
  "Version": "2012-10-17",
  "Statement": [
    {
      "Sid": "VisualEditor0",
      "Effect": "Allow",
      "Action": ["s3:PutObject", "s3:GetObject"],
      "Resource": "arn:aws:s3:::<BUCKETNAME>/*"
    }
  ]
}
```

- Then set the following environment variables, with information from the S3 console.

```
bCMS__AWS_S3_BUCKET_REGION=
bCMS__AWS_S3_BUCKET_NAME=
bCMS__AWS_SERVER_KEY=
bCMS__AWS_SERVER_SECRET_KEY=
bCMS__AWS_S3_CDN=
bCMS__AWS_S3_BUCKET_ENDPOINT=
```

#### [Cloudfront](https://aws.amazon.com/cloudfront/)

Using cloudfront is optional, but will improve image and file download times. Follow AWS guidance to set this up and set the following environment variables:

```
bCMS__AWS_ACCOUNT_CLOUDFRONT_ENABLED=TRUE
bCMS__AWS_ACCOUNT_PRIVATE_KEY=
bCMS__AWS_ACCOUNT_PRIVATE_KEY_ID=
```

Also note that when setting up a policy for the Cloudfront distribution, you must enable:

- Query strings - Include specified query strings response-content-disposition
