# Cloud function triggered by http call 
Google Cloud Function which is a HTTP-Trigger based function. It means that we can directly invoke it via a HTTPs endpoint that will be assigned to our function.

We are going to use this endpoint to send message to our test Slack :slack: channel `test-webshop-cf`

### Steps to run this function
1.  Open GCC by following this link [Google cloud function list](https://console.cloud.google.com/functions/list).
You will see the list already existing functions.
2. Check that you have installed Cloud SDK by running this command in terminal
```
gcloud
```
Check the list installed google cloud command tools
```
gcloud components list
```
If you are not authenticated in GCC then:
```
gcloud auth login
```
3. Clone this repo
```
git clone git@github.com:lemon57/cloud-function-http-trigger-php.git
```
4. Define Slack webhook url in `config.php`. You can find this webhook -> [Slack channel webhook](https://api.slack.com/apps/A03FHHA7URG/incoming-webhooks?).
5. Deploy this function:
```
gcloud functions deploy sendMessageToSlack --trigger-http \
  --region=europe-west1 --runtime=php74
```
6. Check that the function deployed successfully:
```
gcloud functions describe sendMessageToSlack --region=europe-west1
``` 
7. Invoke the function by command:
```
gcloud functions call --data '{"message":"Hello from boozt GCF workshop. Created by {your_name}"}' sendMessageToSlack --region=europe-west1
```
8. Another way to trigger this function:
```
curl -H "Content-Type: application/json" \
 -X POST \
 -d '{"message":"Trigger GCF by curl command. By {your_name}"}' \
 https://<REGION>-<PROJECT_ID>.cloudfunctions.net/sendMessageToSlack
```
Replace REGION by current region in GCC project.
Replace PROJECT_ID by name of our project in GCC. 
You can always check details about current project by this command:
```
gcloud config list
```
and then get more details about your project
```
gcloud projects describe <project_id>
```

Play with other different parameters for `gcloud` command or chack the same functionality in GCC UI.

 :rocket: :google: :cloud:
